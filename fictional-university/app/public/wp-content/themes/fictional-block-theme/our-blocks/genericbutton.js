import { ToolbarGroup, ToolbarButton, Popover, Button, PanelBody, PanelRow, ColorPalette, ColorPicker } from "@wordpress/components";
import { RichText, InspectorControls, BlockControls, __experimentalLinkControl as LinkControl, getColorObjectByColorValue} from "@wordpress/block-editor";
import { registerBlockType } from "@wordpress/blocks";
import {link} from "@wordpress/icons";
import {useState} from '@wordpress/element';
import ourColors from "../inc/ourColors.js";

registerBlockType("ourblocktheme/genericbutton", {
  title: "Generic Button",
  attributes: {
    text: { type: "string" },
    size: { type: "string", default: "large" },
    linkObject: {type: "object", default:{url: ""}},
    colorName: {type: "string", default: "blue"}
  },
  edit: EditComponent,
  save: SaveComponent,
});
function EditComponent(props) {
  const [isLinkPickerVisible, setIsLinkPickerVisible] = useState(false);
  function handleTextChange(x) {
    props.setAttributes({ text: x });
  }

  function buttonHandler(){
    setIsLinkPickerVisible((prev)=> !prev);
  }

  function handleLinkChange(newLink){
    props.setAttributes({linkObject: newLink});
  }

 

  const currentColorValue = ourColors.filter(color=>color.name == props.attributes.colorName)[0].color;

  function handleColorChange(colorCode){
    // from the hex falue that the color palate gives us, we need to find its color name
    const {name}= getColorObjectByColorValue(ourColors,colorCode);
    props.setAttributes({colorName: name});
  }

  return (
    <>
      <BlockControls>
        <ToolbarGroup>
          <ToolbarButton onClick={buttonHandler} icon={link} />
        </ToolbarGroup>
        <ToolbarGroup>
          <ToolbarButton
            isPressed={props.attributes.size === "large"}
            onClick={() => props.setAttributes({ size: "large" })}
          >
            Large
          </ToolbarButton>
          <ToolbarButton
            isPressed={props.attributes.size === "medium"}
            onClick={() => props.setAttributes({ size: "medium" })}
          >
            Medium
          </ToolbarButton>
          <ToolbarButton
            isPressed={props.attributes.size === "small"}
            onClick={() => props.setAttributes({ size: "small" })}
          >
            Small
          </ToolbarButton>
        </ToolbarGroup>
      </BlockControls>
      <InspectorControls>
        <PanelBody title="Color" initialOpen={true} >
          <PanelRow>
            <ColorPalette disableCustomColors={true} clearable={false} colors={ourColors} value={currentColorValue} onChange={handleColorChange} />
          </PanelRow>
        </PanelBody>
      </InspectorControls>
      <RichText
        allowedFormats={[]}
        tagName="a"
        className={`btn btn--${props.attributes.size} btn--${props.attributes.colorName}`}
        value={props.attributes.text}
        onChange={handleTextChange}
      />
      {isLinkPickerVisible && (
        <Popover position="middle center" onFocusOutside={()=>setIsLinkPickerVisible(false)} >
          <LinkControl settings={[]} value={props.attributes.linkObject} onChange={handleLinkChange} />
          <Button variant="primary" onClick={()=> setIsLinkPickerVisible(false)} style={{display: "block", width: "100%"}} > Confirm Link</Button>
        </Popover>
      )}
    </>
  );
}
function SaveComponent(props) {
 
  return (
    <a href={props.attributes.linkObject.url} className={`btn btn--${props.attributes.size} btn--${props.attributes.colorName}`} >{props.attributes.text}</a>
  );
}
