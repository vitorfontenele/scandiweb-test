import "./style.css";

const Header = (props) => {
    const { headerTitle , firstButtonText, firstButtonAction, secondButtonAction , secondButtonText } = props;

    return (
        <header id="header">
            <h1>{headerTitle}</h1>
            <div id="header-buttons">
                <button className="btn btn-confirm" onClick={firstButtonAction}>{firstButtonText}</button>
                <button className="btn btn-remove" onClick={secondButtonAction}>{secondButtonText}</button>
            </div>
        </header>
    );
}

export default Header;