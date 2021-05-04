module.exports = {
  pluginOptions: {
    electronBuilder: {
      preload: "preload.js",
      builderOptions: {
        productName: "Pardus Kataliz",
        buildResources: "build",
        linux: {
          publish: ["github"],
          target: ["AppImage", "deb"],
        },
      },
    },
  },
  chainWebpack: (config) => {
    const svgRule = config.module.rule("svg");
    svgRule.uses.clear();
    svgRule
      .use("vue-loader")
      .loader("vue-loader-v16") // or `vue-loader-v16` if you are using a preview support of Vue 3 in Vue CLI
      .end()
      .use("vue-svg-loader")
      .loader("vue-svg-loader");
  },
};
