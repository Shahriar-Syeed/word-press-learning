wp.blocks.registerBlockType("ourblocktheme/page",{
  title: "Fictional Page",
    supports: {
    align: ["full"],
  },
  attributes:{
    align: {type: "string", default:"full"},
  },
  edit: function(){
    return wp.element.createElement('div', {className: "our-placeholder-block"}, 'Page Placeholder');
  },
  save: function (){
    return null;
  },
});