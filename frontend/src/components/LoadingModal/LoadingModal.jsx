import "./style.css";

const LoadingModal = () => {
    return (
        <div className='modal'>
        <div className='modal-content'>
          <div className='loader'></div>
          <div className='modal-text'>Loading...</div>
        </div>
      </div>
    )
}

export default LoadingModal;