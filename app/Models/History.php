<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fname',
        'mname',
        'lname',
        'birthday',
        'sex',
        'street',
        'brgy',
        'municipality',
        'province',
    ];

    /**
     * Get histories
     * 
     * @param int|null $limit
     */
    public function histories(
        ?int $limit = null,
        bool $paginate = false,
        ?int $page = 1
    ) {
        $records = Client::whereHas('clientUser')
            ->with([
                'latestLogout' => function ($query) {
                    $query->select('client_id', 'created_at');
                },
                'user'
            ]
        );

        if (!is_null($limit)) {
            $records->limit($limit);
        }

        if ($paginate) {
            $perPage = $limit ?? 5;
            if ($page != 1) {
                // dd($page);
            }
            $paginated = $records->paginate($perPage, ['*'], 'page', $page);

            return $paginated;
        }

        return $records->get();
    }
}
