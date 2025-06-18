import { InnerBlocks } from "@wordpress/block-editor";
import {registerBlockType} from "@wordpress/blocks";
import metadata from "./block.json";
import  Edit  from "./edit.js";

registerBlockType(metadata.name,{
  edit: Edit,
  save: function(){
    return <InnerBlocks.Content />
  }
});