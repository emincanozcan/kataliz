const fs = require("fs");
const path = require("path");
import { dialog, app, BrowserWindow } from "electron";

export default function exportToFileListener(event, param) {
  dialog
    .showSaveDialog({
      title: "Kayıt Yeri Seçiniz",
      defaultPath: path.join(app.getPath("desktop"), "pardus-kataliz.sh"),
      buttonLabel: "Kaydet",
      filters: [
        {
          name: "Text Files",
          extensions: ["sh"],
        },
      ],
      properties: [],
    })
    .then((file) => {
      if (!file.canceled) {
        fs.writeFile(file.filePath.toString(), param, function (err) {
          const parsedPath = path.parse(file.filePath);
          const fileName = parsedPath.name + parsedPath.ext;
          if (err) {
            throw err;
          } else {
            const window = BrowserWindow.getFocusedWindow();
            window.webContents.send("open-installation-instructions", fileName);
          }
        });
      }
    })
    .catch((err) => {
      console.log(err);
    });
}
