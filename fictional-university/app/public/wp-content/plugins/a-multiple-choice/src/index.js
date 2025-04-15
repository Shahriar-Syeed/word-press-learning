import "./index.scss";
import {TextControl, Flex, FlexBlock, FlexItem, Button, Icon, PanelBody, PanelRow, ColorPicker} from "@wordpress/components";
import {InspectorControls} from "@wordpress/block-editor";
import {ChromePicker} from "react-color";

(function /*ourStartFunction*/(){
  let locked = false;
  wp.data.subscribe(function(){
    const result = wp.data.select("core/block-editor").getBlocks().filter(block=>block.name === "ourplugin/a-multiple-choice" && block.attributes.correctAnswer === null);

    if(result.length && locked == false){
      locked = true;
      wp.data.dispatch("core/editor").lockPostSaving("noanswer");
    }

    if(!result.length && locked){
      locked = false;
      wp.data.dispatch("core/editor").unlockPostSaving("noanswer");
    }
  });
})();

// ourStartFunction();

wp.blocks.registerBlockType("ourplugin/a-multiple-choice",{
  title: "Are You Making Choice?",
  icon: "list-view",
  category: "common",
  attributes:{
    question: {type:'string'},
    answers: {type:'array', default:[""]},
    correctAnswer: {type: "number", default: null},
    bgColor: {type: "string", default: "EBEBEB"},
  },
  edit: EditComponent,
  save: function (props){
    return null;
  }

});

function EditComponent (props){
    function updateQuestion(value){
      props.setAttributes({question: value});
    }

    function deleteAnswer(indexToDelete){
      const newAnswers = props.attributes.answers.filter((value, index)=>index != indexToDelete);
      props.setAttributes({answers: newAnswers});
      if(indexToDelete == props.attributes.correctAnswer){
        props.setAttributes({correctAnswer : null});
      }
    }

    function markAsCorrect(indexToCorrect){
      props.setAttributes({correctAnswer: indexToCorrect});
    }

    return(
      <div className="a-multiple-choice-edit-block" style={{backgroundColor: props.attributes.bgColor}}>
        <InspectorControls>
          <PanelBody title="Background Color">
            <PanelRow>
              <ChromePicker color={props.attributes.bgColor} onChangeComplete={x=>props.setAttributes({bgColor: x.hex})} disableAlpha={true} />
            </PanelRow>
          </PanelBody>
        </InspectorControls>
        <TextControl label="Question:" value={props.attributes.question} onChange={updateQuestion} style={{fontSize: "20px"}} />
        <p style={{fontSize: "13px", marginBlock: "20px 8px"}}>Answers:</p>
        {props.attributes.answers.map((answer, index)=> (<Flex>
          <FlexBlock>
            <TextControl value={answer} autoFocus={answer == '' && index == props.attributes.answers.length - 1} onChange={newValue => {
              const newAnswers = props.attributes.answers.concat([]);
              newAnswers[index] = newValue;
              props.setAttributes({answers: newAnswers});
            }} />
          </FlexBlock>
          <FlexItem>
            <Button onClick={()=> markAsCorrect(index)}>
              <Icon className="mark-as-answer" icon={props.attributes.correctAnswer == index ? "star-filled" : "star-empty"} />
            </Button>
          </FlexItem>
          <FlexItem>
            <Button isLink className="choice-delete" onClick={()=> deleteAnswer(index)} >Delete</Button>
          </FlexItem>
        </Flex>))}
        {/* <Flex>
          <FlexBlock>
            <TextControl/>
          </FlexBlock>
          <FlexItem>
            <Button>
              <Icon className="mark-as-answer" icon="star-empty" />
            </Button>
          </FlexItem>
          <FlexItem>
            <Button isLink className="choice-delete" >Delete</Button>
          </FlexItem>
        </Flex> */}
        <Button isPrimary onClick={()=>{
          props.setAttributes({answers: props.attributes.answers.concat([''])});
        }} >Add another answer</Button>
        
      </div>
    );
  }