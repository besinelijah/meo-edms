<script setup>
import "leaflet/dist/leaflet.css";
import L from "leaflet";
import { LMap, LTileLayer, LMarker, LTooltip } from "@vue-leaflet/vue-leaflet";
import { ref, watch, onMounted } from 'vue';

const props = defineProps({
  lat: {
    type: Number,
    default: 14.069
  },
  lng: {
    type: Number,
    default: 122.96
  },
  show: {
    type: Boolean,
    default: true,
  },
  isView: {
    type: Boolean,
    default: true
  }
});

const center = ref([props.lat, props.lng]);
const zoom = ref(20);
const tileLayerUrl = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
const markerPosition = ref([props.lat, props.lng]);
const markerTooltip = ref('Click on the map to move me');

const mapRef = ref(null);

onMounted(() => {
  // Center the map on the initial marker position when mounted
  if (mapRef.value) {
    mapRef.value.mapObject.setView(center.value, zoom.value);
  }
});

// Watch for changes in the 'show' prop to re-center the map when opened
watch(() => props.show, (newShow) => {
  if (newShow && mapRef.value) {
    mapRef.value.mapObject.setView(markerPosition.value, zoom.value);
  }
});

// Watch for changes in marker position and update the center of the map
watch(markerPosition, (newPosition) => {
  if (mapRef.value) {
    mapRef.value.mapObject.setView(newPosition, zoom.value);
  }
});

// Watch for lat/lng prop changes to update marker position
watch(() => [props.lat, props.lng], ([newLat, newLng]) => {
  markerPosition.value = [newLat, newLng];
  center.value = [newLat, newLng]; // Update the center if lat/lng change
  if (mapRef.value) {
    mapRef.value.mapObject.setView(markerPosition.value, zoom.value);
  }
});

function onMapClick(event) {
  markerPosition.value = event.latlng;
  markerTooltip.value = "This is the new location";

  // Center the map on the new marker position
  if (mapRef.value) {
    mapRef.value.mapObject.setView(markerPosition.value, zoom.value);
  }
}

const emit = defineEmits(['update:show', 'newLocation']);
const close = () => {
  emit('update:show', false);
  emit('newLocation', markerPosition.value);
};
</script>

<template>
  <div v-if="show" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-4xl">
      <div class="flex justify-between items-center p-4 border-b">
        <h3 class="text-lg font-semibold">Map Location</h3>
        <button @click="close" class="text-gray-500 hover:text-gray-700">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
            </path>
          </svg>
        </button>
      </div>
      <div class="p-4 bg-gray-300 h-[80vh]">
        <LMap ref="map" v-model:zoom="zoom" :center="center" @click="onMapClick">
          <LTileLayer :url="tileLayerUrl" layer-type="base" name="OpenStreetMap" />
          <LMarker :lat-lng="markerPosition">
            <LTooltip>{{ markerTooltip }}</LTooltip>
          </LMarker>
        </LMap>
      </div>
    </div>
  </div>
</template>
