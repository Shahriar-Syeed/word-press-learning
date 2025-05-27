// import apiFetch from "@wordpress/api-fetch";

// import {Button, PanelBody, PanelRow} from "@wordpress/components";

import {InnerBlocks, InspectorControls, MediaUpload, MediaUploadCheck} from '@wordpress/block-editor';

import {registerBlockType} from "@wordpress/blocks";

// import { useEffect } from "@wordpress/element";


registerBlockType("ourblocktheme/slideshow",{
  title: "Slideshow",
    supports: {
    align: ["full"],
  },
  attributes:{
    align: {type: "string", default:"full"},
  },
  edit: EditComponent,
  save: SaveComponent,
});

function SaveComponent(){
  return (<InnerBlocks.Content />);
}

function EditComponent(){
  return (
    <div style={{backgroundColor: "#333", padding: "35px"}}>
      <p style={{textAlign: "center", fontSize: "20px", color: "#fff"}}>Slideshow</p>
      <InnerBlocks allowedBlocks={["ourblocktheme/slide"]} />
    </div>
  );
}