// Application is needs --no-sandbox parameter to work on Pardus.
// Electron's window sandbox options are not works for that case.
// `sysctl kernel.unprivileged_userns_clone=1` command is a one solution proposal - but it forces user to use shell. (It is default settings in Ubuntu btw.)
// Another solution proposal is making chrome-sandbox 4755 but it is not for me - or I did something wrong.

// My solution is adding mini extra layer before application which runs application with --no-sandbox parameter.
// (afterPack hook is running between creating files and packaging them. After creating files, I am manipulating the files.)
// It works but I dont that it is not a good solution btw.

const { chdir } = require("process");
const { spawn } = require("child_process");

async function exec(cmd, args) {
  const child = spawn(cmd, args, { shell: true });
  redirectOutputsToStd(child);
  await new Promise((resolve) => {
    child.once("close", () => resolve());
  });
}

function redirectOutputsToStd(child) {
  const stdout = (data) => process.stdout.write(data.toString());
  const stderr = (data) => process.stderr.write(data.toString());
  child.stdout && child.stdout.on("data", stdout);
  child.stderr && child.stderr.on("data", stderr);
  child.once("close", () => {
    child.stdout && child.stdout.off("data", stdout);
    child.stderr && child.stderr.off("data", stderr);
  });
}

exports.default = async function (context) {
  const dirToBack = process.cwd();
  chdir(context.appOutDir);
  await exec("mv pardus-kataliz pardus-kataliz.bin");
  const runner = `#!/bin/bash
"\${BASH_SOURCE%/*}"/pardus-kataliz.bin "$@" --no-sandbox`;
  await exec(`echo '${runner}' > pardus-kataliz`);
  await exec("chmod +x pardus-kataliz");
  chdir(dirToBack);
};
