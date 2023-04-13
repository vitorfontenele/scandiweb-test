import "./style.css";
import types from "../../utils/types";
import formatToCurrency from "../../utils/formatToCurrency";


const ProductBox = (props) => {
    const { product , checked, index, handleCheckbox } = props;
    const { sku , name, price , type , specialAttributes } = product;
    
    return (
        <article className="product-box">
            <input 
                className="delete-checkbox"
                type="checkbox" 
                checked={checked ?? false} 
                onChange={() => handleCheckbox(index)}
            />
            <h3 className="product-sku">{sku}</h3>
            <h2 className="product-name">{name}</h2>
            <h5 className="product-price">{formatToCurrency(price)} $</h5>
            <h4 className="product-special-attributes">{types[type].formatAttrs(specialAttributes)}</h4>
            
        </article>
    )
}

export default ProductBox;