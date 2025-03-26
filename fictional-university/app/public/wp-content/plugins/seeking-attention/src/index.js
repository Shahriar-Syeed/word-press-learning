wp.blocks.registerBlockType("ourplugin/seeking-attention",{
  title: "Are You Paying Attention?",
  icon: "smiley",
  category: "common",
  edit: function () {

    //what will you see in admin editor screen
    return (<>
    <p>Hello, this is a paragraph.</p>
    <h3>Hi there.</h3>
    </>);
  },
  save: function () {
    //what public will see in your content
    return (<>
    <h1>Hello, this is the frontend.</h1>
    <h2>Hi there. Hello, this is the frontend.</h2>
    </>);
  },
});