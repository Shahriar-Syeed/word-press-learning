import apiFetch from "@wordpress/api-fetch";

import {Button, PanelBody, PanelRow} from "@wordpress/components";

import {InnerBlocks, InspectorControls, MediaUpload, MediaUploadCheck} from '@wordpress/block-editor';

import {registerBlockType} from "@wordpress/blocks";

import defaultImage from '../images/library-hero.jpg';

import { useEffect } from "@wordpress/element";


registerBlockType("ourblocktheme/slide",{
  title: "Slide",
    supports: {
    align: ["full"],
  },
  attributes:{
    themeimage:{type:"string"},
    align: {type: "string", default:"full"},
    imageID: {type: "number"},
    imageURL: {type: "string", default: banner.fallbackimage},
  },
  edit: EditComponent,
  save: SaveComponent,
});

function EditComponent(props){
 useEffect(()=>{
   if(props.attributes.themeimage){
     props.setAttributes({imageURL: `${slide.themeimagepath}${props.attributes.themeimage}`})
    }
 },[]);

 useEffect(()=>{
  if(props.attributes.imageID){
    async function go() {
      console.log('koko');
      const response = await apiFetch({
        path: `/wp/v2/media/${props.attributes.imageID}`,
        method: "GET"
      });
      props.setAttributes({themeimage:"", imageURL: response.media_details.sizes.large.source_url});
      console.log(response.media_details.sizes);
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
      <div className="hero-slider__slide" style={{ backgroundImage: `url('${props.attributes.imageURL}')` }}>
        <div className="hero-slider__interior container">
          <div className="hero-slider__overlay t-center">
            <InnerBlocks allowedBlocks={["ourblocktheme/genericheading", "ourblocktheme/genericbutton"]} />
          </div>
        </div>
      </div>
    </>
);
}
function SaveComponent(){
return <InnerBlocks.Content />;
}