import {registerBlockType} from "@wordpress/blocks";
import metadate from "./block.json";
import  Edit  from "./edit.js";

function Save(props){
 
  return (
    <a href={props.attributes.linkObject.url} className={`btn btn--${props.attributes.size} btn--${props.attributes.colorName}`} >{props.attributes.text}</a>
  );
}

registerBlockType(metadate.name,{
  edit: Edit,
  save: Save,
});