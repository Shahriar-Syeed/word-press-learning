// alert("hello, from our new JS file.");
wp.blocks.registerBlockType("ourplugin/seeking-attention",{
  title: "Are You Paying Attention?",
  icon: "smiley",
  category: "common",
  edit: function () {

    //what will you see in admin editor screen
    return wp.element.createElement("h3", null, "Hello, this is from admin editor screen");
  },
  save: function () {
    //what public will see in your content
    return wp.element.createElement("h1", null, "Hello, this is the frontend");
  },
});