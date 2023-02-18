import axios from 'axios';
import React,{useState,useEffect} from 'react'
import {useLocation} from 'react-router-dom' 
import Spinner from '../Component/Spinner';
export default function Show() {
  const [Product,setProduct]  =  useState([]);
  const [Loader,setLoader] = useState(true);
  const product_slug = window.slug


    const location = useLocation();
    const viewHandler = () =>{
      if (location.pathname) {
        axios.post('/api/addview/' + product_slug).then((d)=>{
          console.log(d.data.data);
        })
      }
    }
  
  const fetchData = () =>{
    axios.get('/api/show/' + product_slug).then((d)=>{
      const {product} = d.data.data
      setProduct(product);
    });
  }
  useEffect(()=>{
    fetchData();
    setLoader(false);
    viewHandler();
  },[]);
  return (
    <React.Fragment>
      {Loader && <Spinner/>}
      {
        !Loader && 
        Product.map((d)=>(
          <div className="card" key={d.id}>
          <div className="card-body">
            <div className="row">
              <div className="col-md-12">
                <h1>{d.name}</h1>
              </div>
              <div className="col-md-12">
                <small><button className='btn btn-success btn-sm'>{d.brand.name}</button></small>
                <p className='btn btn-outline'>Avaliable Colors|</p>
                {d.colors.map((d)=>(
                   <small><button className='btn btn-warning btn-sm'>{d.name}</button></small>
                ))}
               

              </div>
            </div>
            <div className="card">
              <div className="card-body">
                <div className="row">
                  <div className="col-md-4">
                    <a href="" className="btn btn-primary rounded">
                      <i className="fas fa-cart-arrow-down" />
                    </a>
                  </div>
                  <div className="col-md-4">
                    <small>
                      <i className="fas fa-eye" />
                      {d.view_count}
                    </small>
                  </div>
                  <div className="col-md-4">
                    <a href="" className="badge badge-primary">
                      {d.category.name}
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div className="row">
              <div className="col-md-12">
                <img src={d.image_url} className="w-50" alt="" />
              </div>
            </div>
            <div className="row">
              <div className="col-md-12">
                <p dangerouslySetInnerHTML={{ __html:d.description }}>
                </p>
              </div>
            </div>
            <div className="row">
              <div className="col-md-6">
                <label htmlFor="small" className='display-4'>Sale Price:</label>
                <small className='display-4'><em className='text-muted'>{d.sale_price}</em>ks|{d.discount_price}ks</small>
              </div>
              <div className="col-md-6">
                <label htmlFor="small" className='display-4'>Instock Quantity :</label>
                <small className='display-4'>{d.total_quantity}</small>
              </div>
            </div>
          </div>
        </div>
        ))
       
        
        }

    </React.Fragment>
    )
}
