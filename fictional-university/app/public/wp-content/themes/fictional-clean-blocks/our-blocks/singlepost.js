wp.blocks.registerBlockType("ourblocktheme/singlepost",{
  title: "Fictional Single Post",
    supports: {
    align: ["full"],
  },
  attributes:{
    align: {type: "string", default:"full"},
  },
  edit: function(){
    return wp.element.createElement('div', {className: "our-placeholder-block"}, 'Single Post Placeholder');
  },
  save: function (){
    return null;
  },
});