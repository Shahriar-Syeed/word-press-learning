wp.blocks.registerBlocktype("ourdatabaseplugin/petslist",{
  title: "Fictional Univ Pet List",
  icon: 'universal-access-alt',
  edit: function (){
    return wp.element.createElement('div', {
      className: "our-placeholder-block"
    }, "Pets List Placeholder")
  },
  save: function(){
    return null;
  }
});