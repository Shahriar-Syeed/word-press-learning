import apiFetch from "@wordpress/api-fetch";

import {Button, PanelBody, PanelRow} from "@wordpress/components";

import {InnerBlocks, InspectorControls, MediaUpload, MediaUploadCheck, useBlockProps} from '@wordpress/block-editor';

import {registerBlockType} from "@wordpress/blocks";

import { useEffect } from "@wordpress/element";



export default function Edit(props){
  const blockProps = useBlockProps();
  useEffect(()=>{
    if(!props.attributes.imageURL){
      props.setAttributes({imageURL: ourThemeData.themeImagePath + "/images/library-hero.jpg"})
    }
  },[]);
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
    <div {...blockProps}>
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
    </div>
  );
}