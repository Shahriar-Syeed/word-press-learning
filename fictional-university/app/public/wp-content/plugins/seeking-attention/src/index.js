wp.blocks.registerBlockType("ourplugin/seeking-attention",{
  title: "Are You Paying Attention?",
  icon: "smiley",
  category: "common",
  attributes: {
    skyColor: {type: "string" },
    grassColor: {type: "string"},
  },
  edit: function (props) {

    //what will you see in admin editor screen
    function updateSkyColor(e){
      props.setAttributes({skyColor: e.target.value})
    }
    function updateGrassColor(e){
      props.setAttributes({grassColor: e.target.value})
    }
    return (<>
    <input type="text" placeholder="sky color" value={props.attributes.skyColor} onChange={updateSkyColor} />
    <input type="text" placeholder="grass color" value={props.attributes.grassColor} onChange={updateGrassColor} />
    </>);
  },
  save: function (props) {
    //what public will see in your content
    return (<>
    <p>Today the sky is comletely <span className="skyColor">{props.attributes.skyColor}</span> and the grass is {props.attributes.grassColor}.</p>
    </>);
  },
  deprecated: [{
    attributes: {
    skyColor: {type: "string" },
    grassColor: {type: "string"},
  },
  save: function (props) {
    //what public will see in your content
    return (<>
    <p>Today the sky is <span className="skyColor">{props.attributes.skyColor}</span> and the grass is {props.attributes.grassColor}.</p>
    </>);
  },},{
     attributes: {
      skyColor: {type: "string" },
      grassColor: {type: "string"},
  },
  save: function (props) {
    //what public will see in your content
    return (<>
      <p>Today the sky is absolutely <span className="skyColor">{props.attributes.skyColor}</span> and the grass is {props.attributes.grassColor}.</p>
    </>);
  },
  },]
});