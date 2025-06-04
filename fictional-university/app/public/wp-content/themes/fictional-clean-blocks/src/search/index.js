import {registerBlockType} from "@wordpress/blocks";
import metadate from "./block.json";
import  Edit  from "./edit.js";
import {InnerBlocks} from "@wordpress/block-editor"

registerBlockType(metadate.name,{
  edit: Edit,
  save: ()=> <InnerBlocks.Content />
});