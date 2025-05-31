wp.blocks.registerBlockType("ourblocktheme/blogindex",{
  title: "Fictional Blog Index",
    supports: {
    align: ["full"],
  },
  attributes:{
    align: {type: "string", default:"full"},
  },
  edit: function(){
    return wp.element.createElement('div', {className: "our-placeholder-block"}, 'Blog Index Placeholder');
  },
  save: function (){
    return null;
  },
});