import apiFetch from "@wordpress/api-fetch";

import {Button, PanelBody, PanelRow} from "@wordpress/components";

import {InnerBlocks, InspectorControls, MediaUpload, MediaUploadCheck} from '@wordpress/block-editor';

import {registerBlockType} from "@wordpress/blocks";

import defaultImage from '../images/library-hero.jpg';

import { useEffect } from "@wordpress/element";

// wp.blocks.registerBlockType("ourblocktheme/banner",{
//   title: "Banner",
//   edit: EditComponent,
//   save: SaveComponent,
// });

registerBlockType("ourblocktheme/banner",{
  title: "Banner",
    supports: {
    align: ["full"],
  },
  attributes:{
    align: {type: "string", default:"full"},
    imageID: {type: "number"},
    imageURL: {type: "string", default: ourThemeData.themeImagePath + "/images/library-hero.jpg"},
  },
  edit: EditComponent,
  save: SaveComponent,
});

function EditComponent(props){
 useEffect(()=>{
  if(props.attributes.imageID){
    async function go() {
      const response = await apiFetch({
        path: `/wp/v2/media/${props.attributes.imageID}`,
        method: "GET"
      });
      props.setAttributes({imageURL: response.media_details.sizes.pageBanner.source_url});
    }
    go();
  }
 },[props.attributes.imageID]);
  function onFileSelect(e){
    console.log(e.id);
    props.setAttributes({imageID: e.id});
  }

  return (
    <>
    <InspectorControls>
      <PanelBody title="Background" initialOpen={true} >
        <PanelRow>
          <MediaUploadCheck>
            <MediaUpload onSelect={onFileSelect} value={props.attributes.imageID} render={({open}) => {
              return (<Button onClick={open}>Choose Image</Button>);
            }} />
          </MediaUploadCheck>
        </PanelRow>
      </PanelBody>
    </InspectorControls>
      <div className="page-banner">
        <div className="page-banner__bg-image" style={{ backgroundImage: `url('${props.attributes.imageURL}')` }}></div>
        <div className="page-banner__content container t-center c-white">
          <InnerBlocks allowedBlocks={["ourblocktheme/genericheading", "ourblocktheme/genericbutton"]} />
        </div>
      </div>
    </>
);
}
function SaveComponent(){
//    return (
//   <div className="page-banner">
//     <div className="page-banner__bg-image" style={{ backgroundImage: `url(${defaultImage})` }}></div>
//     <div className="page-banner__content container t-center c-white">
//       <InnerBlocks.Content />
//     </div>
// </div>);
return <InnerBlocks.Content />;
}