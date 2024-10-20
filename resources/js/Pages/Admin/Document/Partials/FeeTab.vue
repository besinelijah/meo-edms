<script setup>
const fees = {
  "data": [
    {
      "title": "Occupancy Permit-Division (cost of bldg.)",
      "status": "Inactive",
    },
    {
      "title": "Line and Grade Fee (Engineering Office)",
      "status": "Inactive",
    },
    {
      "title": "Electrical Fee (Engineering Office)",
      "status": "Active",
    },
    {
      "title": "Inspection Fee (Engineering Office)",
      "status": "Active",
    },
    {
      "title": "Grand Total Fees",
      "status": "Inactive",
    },
    {
      "title": "Insurance of Certificate of Annual Inspection",
      "status": "Inactive",
    },
    {
      "title": "Filing Fee (Engineering Office)",
      "status": "Inactive",
    },
    {
      "title": "Processing Fee (Engineering Office)",
      "status": "Inactive",
    },
    {
      "title": "Insurance of Certificate (Engineering Office)",
      "status": "Inactive",
    },
    {
      "title": "Renewal Certificate (Engineering Office)",
      "status": "Inactive",
    },
    {
      "title": "Mechanial/Equipment Inspection Fee (Engineering Office)",
      "status": "Inactive",
    },
  ]
};
</script>

<template>
  <div class="w-3/5">
    
    <table class="w-full text-sm text-left">
      <thead class="text-md text-gray-700 uppercase">
        <tr>
          <th>Document Title</th>
          <th class="w-[50px]">Status</th>
          <th class="w-[15px]">Action</th>
        </tr>
      </thead>
      <tbody>
        <template v-for="(item, index) in fees.data" :key="index">
          <tr class="border-y text-sm text-gray-900">
            <td class="!py-2">{{ item.title }}</td>
            <td class="!py-2">{{ item.status }}</td>
            <td class="!py-2 text-gray-900 text-center">
              <i class="fas fa-pen-to-square w-5 h-5"></i>
            </td>
          </tr>
        </template>
      </tbody>
    </table>
  </div>
</template>