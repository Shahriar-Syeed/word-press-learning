import {registerBlockType} from "@wordpress/blocks";
import metadata from "./block.json";
import  Edit  from "./edit.js";
import {InnerBlocks} from "@wordpress/block-editor"

registerBlockType(metadata.name,{
  edit: Edit,
  save: ()=> <InnerBlocks.Content />
});