import {registerBlockType} from "@wordpress/blocks";
import metadate from "./block.json";

function Edit(){
  return (
    <div>
      Hi form index js footer
    </div>
  );
}

registerBlockType(metadate.name,{
  edit: Edit
});