<script setup>
const requests = {
  "data": [
    {
      "clientName": "Intia, Justine Nicole",
      "documentType": "Sanitary Permit",
      "requires": "Original",
      "status": "Not Set"
    },
    {
      "clientName": "Mandia, Alyana",
      "documentType": "Barangay Clearance",
      "requires": "Copy",
      "status": "Completed"
    },
    {
      "clientName": "Cabarle, Sophia Mae",
      "documentType": "Community Tax Certificate",
      "requires": "Copy",
      "status": "Completed"
    },
    {
      "clientName": "Besin, Elijah",
      "documentType": "Barangay Clearance",
      "requires": "Copy",
      "status": "Not Set"
    },
    {
      "clientName": "Labrador, Justine",
      "documentType": "Community Tax Certificate",
      "requires": "Copy",
      "status": "Not Set"
    },
  ]
};
</script>

<template>
  <div>
    <table class="w-full text-sm text-left">
      <thead class="text-md text-gray-700 uppercase">
        <tr>
          <th class="w-[5%]"></th>
          <th>Name of Client</th>
          <th>Document</th>
          <th>Requires</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <template v-for="(item, index) in requests.data" :key="index">
          <tr class="border-y text-sm text-gray-900">
            <td class="!py-2">
              <span class="flex items-center h-5">
                <input type="checkbox" class="w-4 h-4" />
              </span>
            </td>
            <td class="!py-2">{{ item.clientName }}</td>
            <td class="!py-2">{{ item.documentType }}</td>
            <td class="!py-2">{{ item.requires }}</td>
            <td class="!py-2">{{ item.status }}</td>
          </tr>
        </template>
      </tbody>
    </table>
  </div>
</template>