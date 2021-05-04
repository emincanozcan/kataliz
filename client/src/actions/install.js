import store from "../global-state/store";

function generateInstallationScriptFromBucket() {
  return store.bucket.value.map((appId) => {
    const pardusApp = store.pardusApps.value.find((app) => app.id === appId);
    const { id } = pardusApp;
    const scripts = pardusApp.scripts.map((script) =>
      script.replace("sudo", "")
    );
    scripts.push(
      'find /etc/apt/sources.list.d/ -name "*.save" -type f -delete'
    );
    const cmd = scripts.join(";");
    return { id, cmd };
  });
}

function install() {
  // console.log(generateInstallationScriptFromBucket());
  window.ipcRenderer.send("install", generateInstallationScriptFromBucket());
}

export default { generateInstallationScriptFromBucket, install };
