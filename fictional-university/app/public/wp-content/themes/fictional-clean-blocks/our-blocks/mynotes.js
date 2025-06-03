wp.blocks.registerBlockType("ourblocktheme/mynotes",{
  title: "Fictional My Notes",
    supports: {
    align: ["full"],
  },
  attributes:{
    align: {type: "string", default:"full"},
  },
  edit: function(){
    return wp.element.createElement('div', {className: "our-placeholder-block"}, 'My Notes Placeholder');
  },
  save: function (){
    return null;
  },
});