const fs = require("fs");
const path = require("path");
import { dialog, app } from "electron";

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
      // Stating whether dialog operation was cancelled or not.
      if (!file.canceled) {
        const parsedPath = path.parse(file.filePath);
        const dir = parsedPath.dir;
        const name = parsedPath.name;
        fs.writeFile(
          path.join(dir, name + "_KURULUM.txt"),
          `Kurulumu gerçekleştirmek için Pardus işletim sisteminde sırasıyla şu adımları takip ediniz.
          // buraya kurulum talimatlari yazilacak.`,
          function (err) {
            if (err) throw err;
          }
        );
        fs.writeFile(file.filePath.toString(), param, function (err) {
          if (err) throw err;
        });
      }
    })
    .catch((err) => {
      console.log(err);
    });
}
