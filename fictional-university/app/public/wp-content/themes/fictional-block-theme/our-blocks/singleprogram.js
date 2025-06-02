wp.blocks.registerBlockType("ourblocktheme/singleprogram",{
  title: "Fictional Single Program",
    supports: {
    align: ["full"],
  },
  attributes:{
    align: {type: "string", default:"full"},
  },
  edit: function(){
    return wp.element.createElement('div', {className: "our-placeholder-block"}, 'Single Program Placeholder');
  },
  save: function (){
    return null;
  },
});