import store from "../global-state/store";

function generateShellScriptFromBucket() {
  const totalToInstall = store.bucket.value.length;
  const outputRedirection = ">> kataliz_logs_$logDate.txt 2> /dev/null";
  let script = `#!/bin/sh 
logDate=$(date +%s)
echo "Kurulum öncesi hazırlıklar gerçekleştiriliyor. "
sudo apt update -y ${outputRedirection}
sudo apt-get install software-properties-common -y ${outputRedirection}
echo "Kurulum öncesi hazırlıklar tamamlandı. Yüklemeler başlatılıyor."
`;

  store.bucket.value.forEach((id, key) => {
    const pardusApp = store.pardusApps.value.find((app) => app.id === id);
    const { name } = pardusApp;
    const leading = `${key + 1} / ${totalToInstall}`;
    let appScripts = pardusApp.scripts
      .map((line) => line + " " + outputRedirection)
      .join("\n");

    script += [
      "\n",
      "# ------------ #",
      `echo '${leading} ${name} adlı program yükleniyor, lütfen bekleyiniz.'`,
      appScripts,
      'sudo find /etc/apt/sources.list.d/ -name "*.save" -type f -delete',
      `echo '${leading} ${name} adlı programın yüklemesi tamamlandı.'`,
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
