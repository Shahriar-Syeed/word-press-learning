import "./index.scss";
import {TextControl, Flex, FlexBlock, FlexItem, Button, Icon} from "@wordpress/components";


wp.blocks.registerBlockType("ourplugin/a-multiple-choice",{
  title: "Are You Making Choice?",
  icon: "list-view",
  category: "common",
  attributes:{
    question: {type:'string'},
    answers: {type:'array', default:["red", "blue"]},
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
    }
    return(
      <div className="a-multiple-choice-edit-block">

        <TextControl label="Question:" value={props.attributes.question} onChange={updateQuestion} style={{fontSize: "20px"}} />
        <p style={{fontSize: "13px", marginBlock: "20px 8px"}}>Answers:</p>
        {props.attributes.answers.map((answer, index)=> (<Flex>
          <FlexBlock>
            <TextControl value={answer} autoFocus={answer == null} onChange={newValue => {
              const newAnswers = props.attributes.answers.concat([]);
              newAnswers[index] = newValue;
              props.setAttributes({answers: newAnswers});
            }} />
          </FlexBlock>
          <FlexItem>
            <Button>
              <Icon className="mark-as-answer" icon="star-empty" />
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
          props.setAttributes({answers: props.attributes.answers.concat([null])});
        }} >Add another answer</Button>
        
      </div>
    );
  }