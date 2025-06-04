import {registerBlockType} from "@wordpress/blocks";
import metadate from "./block.json";
import  Edit  from "./edit.js";

registerBlockType(metadate.name,{
  edit: Edit
});