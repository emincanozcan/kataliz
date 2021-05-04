import { ref } from "vue";
import axios from "axios";

const loading = ref(true);
const pardusApps = ref([]);
const nonPardusApps = ref([]);
const appPackages = ref([]);
const bucket = ref([]);

async function fetchData() {
  try {
    const response = await axios.get(
      "https://kataliz-admin.emincanozcan.com/api/get-all-data"
    );
    const data = response.data.data;
    pardusApps.value = data["pardus_apps"];
    nonPardusApps.value = data["non_pardus_apps"];
    appPackages.value = data["app_packages"];
  } catch (e) {
    console.error("API DATA FETCH ERROR", e);
  }
}

function addToBucket(pardusAppId) {
  if (bucket.value.includes(pardusAppId)) {
    return;
  }
  bucket.value.push(pardusAppId);
}

function removeFromBucket(pardusAppId) {
  bucket.value = bucket.value.filter((item) => item !== pardusAppId);
}

function isInBucket(item) {
  if (Array.isArray(item)) {
    let flag = true;
    item.forEach((i) => (flag = flag && isInBucket(i)));
    return flag;
  }
  return bucket.value.includes(item);
}

export default {
  loading,
  pardusApps,
  nonPardusApps,
  appPackages,
  fetchData,
  bucket,
  addToBucket,
  removeFromBucket,
  isInBucket,
};
