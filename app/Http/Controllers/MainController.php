<?php

namespace App\Http\Controllers;

use App\Http\Requests\{
    LoginRequest,
    RegisterRequest
};
use App\Models\{
    Client,
    Log,
    Requirement,
    User
};
use Illuminate\Http\{
    RedirectResponse,
    Request
};

use Illuminate\Support\Facades\{Auth, Hash, Storage};
use Inertia\Inertia;

class MainController extends Controller
{
    /**
     * Register new user
     * 
     * @param Request $request
     */
    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();

        $client = Client::create([
            'fname' => $validated['fname'],
            'mname' => $validated['mname'] ?? null,
            'lname' => $validated['lname'],
            'sex' => $validated['sex'],
            'street' => $validated['street'] ?? null,
            'brgy' => $validated['brgy'],
            'municipality' => $validated['municipality'],
            'province' => $validated['province']
        ]);
        // die($client->fname);
        if ($client) {
            $user = User::create([
                'client_id' => $client->id,
                'email' => $validated['email'] ?? null,
                'password' => $validated['password'],
                'isAdmin' =>  $validated['type'],
                'contact_number' =>  $validated['contact_number'],
                'username' => $validated['fname'],
            ]);
        }

        return redirect()->route('login.index', ['type' => $validated['type']]);
    }

    public function login(LoginRequest $request)
    {
        // Validate and extract the request data
        $credentials = $request->validated();
        $username = $credentials['email'];
        $isAdmin = $request->type == 1;
    
        if ($request->type==1 || $request->type==0) {
            $user = User::where('email', $username)
                ->orWhere('contact_number', $username)
                ->where('isAdmin', $isAdmin)
                ->first();
            if($user){
            // Check if 'type' is set to '1' (indicating admin login)
            if ($request->type == $user->isAdmin) {

                if ($user && Hash::check($credentials['password'], $user->password)) {
                    Auth::login($user);

                    $client = Client::where('id', $user->client_id)->first();
                    // Store additional data in the session
                    if ($client) {
                        $request->session()->put("fName", $client->fname); // Add client's first name to session
                    }

                    // Regenerate session to prevent session fixation
                    $request->session()->regenerate();

                    // // Redirect based on user type

                    return $user->isAdmin ? redirect()->intended('admin/dashboard') : redirect()->route('documentview');
                }
            } else if ($user->isAdmin == 0) {
                return back()->withErrors([
                    'email' => 'The provided credentials do not match our records.'
                ])->onlyInput('email');
            } else if ($user->isAdmin == 1) {

                return back()->withErrors([
                    'email' => 'The provided credentials do not match our records.'
                ])->onlyInput('email');
            }
            // If authentication fails, redirect back with error message
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.'
            ])->onlyInput('email');
            }else{
                return back()->withErrors([
                    'email' => 'The provided credentials do not match our records.'
                ])->onlyInput('email');
                    
            }
        }else{
             // If authentication fails, redirect back with error message
             return back()->withErrors([
                'email' => 'Something went Wrong.'
            ])->onlyInput('email');
        }
    }

    /**
     * Login admin
     * 
     * @param
     */
    public function loginAdmin(LoginRequest $request)
    {
        if (Auth::attempt($request->validated())) {
            $request->session()->regenerate();
            return redirect()->intended('admin/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentails do not match our records.'
        ])->onlyInput('email');
    }

    /**
     * Logout user
     * 
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        $user = Auth::user();
        if (!$user->isAdmin) {
            Log::create([
                'client_id' => $user->client_id,
                'description' => 'logout'
            ]);
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    public function loginIndex(Request $request)
    {
        return Inertia::render('Auth/Login', [
            'type' => $request->type
        ]);
    }

    public function registerIndex(Request $request)
    {
        return Inertia::render('Auth/Register', [
            'type' => $request->type
        ]);
    }

    public function home()
    {
        return Inertia::render('Home');
    }

    public function getBusinessReqs()
    {
        $requirements = Requirement::getRequirements(null, 1);

        return Inertia::render('Client/DocumentViewBusinessPermit', [
            'requirements' => $requirements
        ]);
    }
    public function getBuildingReqs()
    {
        $requirements = Requirement::getRequirements(null, 2);

        return Inertia::render('Client/DocumentViewBldgPermit', [
            'requirements' => $requirements
        ]);
    }
    public function getBusinessRenewalReqs()
    {
        $requirements = Requirement::getRequirements(null, 3);

        return Inertia::render('Client/DocumentViewRenewal', [
            'requirements' => $requirements
        ]);
    }
}
