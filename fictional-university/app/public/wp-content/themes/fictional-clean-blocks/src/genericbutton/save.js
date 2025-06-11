
export default function Save(props){
 
  return (
    <a href={props.attributes.linkObject.url} className={`btn btn--${props.attributes.size} btn--${props.attributes.colorName}`} >{props.attributes.text}</a>
  );
}