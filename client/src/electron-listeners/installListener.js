const path = require("path");
const fs = require("fs");
const { BrowserWindow, app } = require("electron");
const sudo = require("sudo-prompt");
const { exec } = require("child_process");

const basePath = path.join(app.getPath("appData"), "tmp", "program");
const baseCheckPath = path.join(basePath, "check");
const getShellPath = (id) => path.join(basePath, id + ".txt");
const getCheckPath = (id) => path.join(baseCheckPath, id + ".txt");

export default function installListener(event, data) {
  const window = BrowserWindow.getFocusedWindow();
  window.webContents.send("open-installation-screen");
  clearTmp();

  const preInstallationCheckPath = getCheckPath("pre-installation");

  const watcherInterval = setInterval(() => watcher(window), 100);
  const command =
    `cat /dev/null > ${preInstallationCheckPath} && echo 'in-progress' > ${preInstallationCheckPath};
     ( ( apt update -y && echo 'end' > ${preInstallationCheckPath} ) || 
     echo 'error' > ${preInstallationCheckPath} ); ` +
    data
      .map((app) => {
        const checkPath = getCheckPath(app.id);
        const shellPath = getShellPath(app.id);
        console.log({ checkPath, shellPath });
        return ` cat /dev/null > ${checkPath}; echo 'in-progress' > ${checkPath}; cat /dev/null > ${shellPath}; echo '${app.cmd}' > ${shellPath};
        ( (sh ${shellPath} && echo 'end' > ${checkPath}) || ( echo 'error' > ${checkPath}) ); `;
      })
      .join("");
  window.webContents.send("installation-start");
  sudo.exec(command, { name: "Pardus Kataliz" }, (err, stdout, stderr) => {
    if (err) {
      console.log(err);
      window.webContents.send("installation-error", { err });
      return;
    }
    setTimeout(() => {
      clearInterval(watcherInterval);
      watcher(window);
      console.log({ stdout, stderr });
      // window.webContents.send("installation-stdout", { stdout });
      // window.webContents.send("installation-stderr", { stderr });
      window.webContents.send("installation-end");
    }, 120);
  });
}

function clearTmp() {
  exec("rm -rf " + basePath, function () {
    mkdirF(basePath);
    mkdirF(baseCheckPath);
  });
}

function mkdirF(dir) {
  if (fs.existsSync(dir)) return true;
  const dirname = path.dirname(dir);
  mkdirF(dirname);
  fs.mkdirSync(dir);
}

function watcher(window) {
  fs.readdirSync(baseCheckPath).forEach((file) => {
    const id = file.replace(".txt", "");
    const status = fs.readFileSync(getCheckPath(id)).toString().trim();
    window.webContents.send("installation-update", { id, status });
  });
}
