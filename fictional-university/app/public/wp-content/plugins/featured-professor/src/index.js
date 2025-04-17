import "./index.scss";
import { select, useSelect } from "@wordpress/data";
import { useState, useEffect } from "react";
import apiFetch from "@wordpress/api-fetch";
// import { __ } from "@wordpress/i18n";
// import { RawHTML } from "@wordpress/element";

wp.blocks.registerBlockType("ourplugin/featured-professor", {
  title: "Professor Callout",
  description:
    "Include a short description and link to a professor of your choice",
  icon: "welcome-learn-more",
  category: "common",
  attributes: {
    profId: { type: "string" },
  },
  edit: EditComponent,
  save: function () {
    return null;
  },
});

function EditComponent(props) {
  const [thePreview, setThePreview] = useState("");

  useEffect(() => {
    // if(props.attributes.profId == ""){
    //   setThePreview("");
    //   return ()=>{
    //     updateTheMeta();
    //   };
    // }
    if (props.attributes.profId) {
      updateTheMeta();
      async function go() {
        const response = await apiFetch({
          path: `featuredProfessor/getHTML?profId=${props.attributes.profId}`,
          method: "GET",
        });
        setThePreview(response);
        console.log(response);
      }
      go();
    }
  }, [props.attributes.profId]);

  useEffect(() => {
    return () => {
      updateTheMeta();
    };
  }, []);

  function updateTheMeta() {
    const profsForMeta = wp.data
      .select("core/block-editor")
      .getBlocks()
      .filter((value) => value.name == "ourplugin/featured-professor")
      .map((x) => x.attributes.profId)
      .filter((value, index, arr) => arr.indexOf(value) == index);
    console.log(
      "core/block-editor",
      wp.data.select("core/block-editor").getBlocks()
    );
    console.log("propsForMeta", profsForMeta);
    wp.data
      .dispatch("core/editor")
      .editPost({
        meta: { featuredprofessor: profsForMeta },
      }); /* propsForMet = array of props.attributes.profId*/
    // wp.data.dispatch("core/editor").editPost({meta: {featuredprofessor: profsForMeta}})
  }
  const allProfessors = useSelect((select) => {
    return select("core").getEntityRecords("postType", "professor", {
      per_page: -1,
    });
  });

  console.log(allProfessors);

  if (allProfessors == null) return <p>Loading...</p>;

  return (
    <div className="featured-professor-wrapper">
      <div className="professor-select-container">
        <select
          onChange={(e) => props.setAttributes({ profId: e.target.value })}
        >
          <option value="">Select a professor</option>
          {allProfessors.map((professor) => (
            <option
              value={professor.id}
              selected={props.attributes.profId == professor.id}
            >
              {professor.title.rendered}
            </option>
          ))}
          ;
        </select>
      </div>
      <div dangerouslySetInnerHTML={{ __html: thePreview }}></div>
      {/* {thePreview ? (
        <RawHTML>
          {thePreview}
        </RawHTML>
      ) : (
        <p>{__('Select a professor to see preview', 'your-text-domain')}</p>
      )} */}
    </div>
  );
}
