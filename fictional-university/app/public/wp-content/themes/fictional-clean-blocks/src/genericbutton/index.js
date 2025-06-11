import {registerBlockType} from "@wordpress/blocks";
import metadate from "./block.json";
import  Edit  from "./edit.js";
import  Save  from "./save.js";

registerBlockType(metadate.name,{
  edit: Edit,
  save: Save,
});