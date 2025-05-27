wp.blocks.registerBlockType("ourblocktheme/footer",{
  title: "Fictional Footer",
    supports: {
    align: ["full"],
  },
  attributes:{
    align: {type: "string", default:"full"},
  },
  edit: function(){
    return wp.element.createElement('div', {className: "our-placeholder-block"}, 'Footer Placeholder');
  },
  save: function (){
    return null;
  },
});