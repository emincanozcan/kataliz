import store from "../global-state/store";

function generateShellScriptFromBucket() {
  let script = `#!/bin/sh 
sudo apt update -y
sudo apt-get install software-properties-common -y
`;
  store.bucket.value.forEach((id) => {
    const pardusApp = store.pardusApps.value.find((app) => app.id === id);
    let base = [
      "\n",
      "# ------------",
      `echo '${pardusApp.name} adlı program yüklenecek.'`,
    ].join("\n");
    script += [
      base,
      pardusApp.scripts.join("\n"),
      'sudo find /etc/apt/sources.list.d/ -name "*.save" -type f -delete',
    ].join("\n");
  });

  return script;
}

function exportToFile() {
  window.ipcRenderer.send("exportBucket", generateShellScriptFromBucket());
}

export default {
  generateShellScriptFromBucket,
  exportToFile,
};
