wp.blocks.registerBlockType("ourblocktheme/programarchive",{
  title: "Fictional Program Archive",
    supports: {
    align: ["full"],
  },
  attributes:{
    align: {type: "string", default:"full"},
  },
  edit: function(){
    return wp.element.createElement('div', {className: "our-placeholder-block"}, 'Program Archive Placeholder');
  },
  save: function (){
    return null;
  },
});