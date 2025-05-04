import { RichText } from "@wordpress/block-editor";
import { registerBlockType } from "@wordpress/blocks";

registerBlockType("ourblocktheme/genericheading", {
  title: "GenericHeading",
  attributes: {
    text: { type: "string" },
    size: { type: "string", default: "large" },
  },
  edit: EditComponent,
  save: SaveComponent,
});
// wp.blocks.registerBlockType("ourblocktheme/genericheading",{
//   title: "GenericHeading",
//   attributes: {text:{type:"string"},size:{type:"string", default:"large"},},
//   edit: EditComponent,
//   save: SaveComponent,
// });
function EditComponent(props) {
  function handleTextChange(x) {
    props.setAttributes({ text: x });
  }

  return (
    <>
      <RichText
        allowedFormats={["core/bold", "core/italic"]}
        tagName="h1"
        className={`headline headline--${props.attributes.size}`}
        value={props.attributes.text}
        onChange={handleTextChange}
      />
    </>
  );
}
function SaveComponent() {
  return <h1 className="">This is our heading block</h1>;
}
