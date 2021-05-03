import { ref } from "vue";
import axios from "axios";

const loading = ref(true);
const pardusApps = ref([]);
const nonPardusApps = ref([]);
const appPackages = ref([]);

async function fetchData() {
  try {
    const response = await axios.get("http://localhost/api/get-all-data");
    console.log("apiresponse", response);
    const data = response.data.data;
    pardusApps.value = data["pardus_apps"];
    nonPardusApps.value = data["non_pardus_apps"];
    appPackages.value = data["app_packages"];
  } catch (e) {
    console.error("API DATA FETCH ERROR", e);
  }
}

export default {
  loading,
  pardusApps,
  nonPardusApps,
  appPackages,
  fetchData,
};
