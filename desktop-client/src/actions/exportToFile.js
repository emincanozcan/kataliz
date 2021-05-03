import store from "../global-state/store";
function generateShellScriptContent() {
  const items = store.pardusApps.filter((app) =>
    store.bucket.value.includes(app.id)
  );
  console.log(items);
}
// function exportOnPardus() {}
export default {
  generateShellScriptContent,
};
