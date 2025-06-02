wp.blocks.registerBlockType("ourblocktheme/singleprofessor",{
  title: "Fictional Single Professor",
    supports: {
    align: ["full"],
  },
  attributes:{
    align: {type: "string", default:"full"},
  },
  edit: function(){
    return wp.element.createElement('div', {className: "our-placeholder-block"}, 'Single Professor Placeholder');
  },
  save: function (){
    return null;
  },
});