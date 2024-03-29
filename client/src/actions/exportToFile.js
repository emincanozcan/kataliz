import store from "../global-state/store";

function generateShellScriptFromBucket() {
  const totalToInstall = store.bucket.value.length;
  const outputRedirection = ">> kataliz_logs_$logDate.txt 2> /dev/null";
  let script = `#!/bin/sh 
logDate=$(date +%s)
echo "Kurulum öncesi hazırlıklar gerçekleştiriliyor. "
sudo apt update -y ${outputRedirection}
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
      `echo '${leading} ${name} adlı programın yüklemesi tamamlandı.'`,
    ].join("\n");
  });

  return script;
}

function pardusExport() {
  window.ipcRenderer.send("exportBucket", generateShellScriptFromBucket());
}

function webExport() {
  const element = document.createElement("a");
  element.setAttribute(
    "href",
    "data:text/plain;charset=utf-8," +
      encodeURIComponent(generateShellScriptFromBucket())
  );
  element.setAttribute("download", "pardus-kataliz.sh");
  element.style.display = "none";
  document.body.appendChild(element);
  element.click();
  document.body.removeChild(element);
  window.dispatchEvent(
    new CustomEvent("open-installation-instructions", {
      detail: { fileName: "pardus-kataliz.sh" },
    })
  );
}

export default {
  generateShellScriptFromBucket,
  pardusExport,
  webExport,
};
