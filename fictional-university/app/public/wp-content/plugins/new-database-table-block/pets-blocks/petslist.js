wp.blocks.registerBlockType("ourdatabaseplugin/petslist",{
  title: "Fictional University Pets List",
   icon: 'universal-access-alt',
  category: 'widgets',
  edit:function(){
    return wp.element.createElement("div", {className:"our-placeholder-block"}, "Pets List Placeholder")
  },
  save: function(){
    return null;
  }
});