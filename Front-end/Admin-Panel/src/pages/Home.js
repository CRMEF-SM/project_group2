// @ts-nocheck


import {
  Card,
  Col,
  Row,
  Typography,
  Upload,
  message,
  Button,
} from "antd";
import {
  ToTopOutlined,
} from "@ant-design/icons";


import { useEffect, useState } from "react";
import axios from "axios";
import { Table } from "react-bootstrap";

function Home() {
  const { Title} = Typography;

  const [data, setData] = useState([]);
  const [count, setCount] = useState([]);
  

  //users count
  const getCount = async () => {
  await axios.get(`http://localhost:3004/userCount`)
  .then((response) =>{
    const counts = response.data.count;
    console.log("counts",counts);
    setCount(counts );
} );
  
  }

  // students who are waiting for there parents- ist 
  const  getWaiting = async () => {
    await axios.get(`http://localhost/api/waiting_list`)
    .then((response) =>{
      const waiting = response.data;
      console.log("waiting",waiting);
      setData(waiting );
  } );
    
    }

  useEffect(()=> getWaiting(),
  getCount(),[]);

  const profile = [
    <svg
      width="22"
      height="22"
      viewBox="0 0 20 20"
      fill="#5CA89F"
      color="#5CA89F"
      xmlns="http://www.w3.org/2000/svg"
      key={0}
    >
      <path
        d="M9 6C9 7.65685 7.65685 9 6 9C4.34315 9 3 7.65685 3 6C3 4.34315 4.34315 3 6 3C7.65685 3 9 4.34315 9 6Z"
        fill="#fff"
      ></path>
      <path
        d="M17 6C17 7.65685 15.6569 9 14 9C12.3431 9 11 7.65685 11 6C11 4.34315 12.3431 3 14 3C15.6569 3 17 4.34315 17 6Z"
        fill="#fff"
      ></path>
      <path
        d="M12.9291 17C12.9758 16.6734 13 16.3395 13 16C13 14.3648 12.4393 12.8606 11.4998 11.6691C12.2352 11.2435 13.0892 11 14 11C16.7614 11 19 13.2386 19 16V17H12.9291Z"
        fill="#fff"
      ></path>
      <path
        d="M6 11C8.76142 11 11 13.2386 11 16V17H1V16C1 13.2386 3.23858 11 6 11Z"
        fill="#fff"
      ></path>
    </svg>,
  ];
  
  const counting = [
    
    {
      today: "Users",
      title: count,
      icon: profile,
      bnb: "bnb2",
    }
  ];


  
  return (
    <>
      <div className="layout-content">
        <Row className="rowgap-vbox" gutter={[24, 0]}>
          {counting.map((c, index) => (
            <Col
              key={index}
              xs={24}
              sm={24}
              md={12}
              lg={6}
              xl={6}
              className="mb-24"
            >
              <Card bordered={false} className="criclebox ">
                <div className="number">
                  <Row align="middle" gutter={[24, 0]}>
                    <Col xs={18}>
                      <span>{c.today}</span>
                      <Title level={3}>
                        {c.title} <small className={c.bnb}>{c.persent}</small>
                      </Title>
                    </Col>
                    <Col xs={6}>
                      <div className="icon-box">{c.icon}</div>
                    </Col>
                  </Row>
                </div>
              </Card>
            </Col>
          ))}
        </Row>

      

        <Row gutter={[24, 0]}>
          <Col sm={24} md={24}  className="mb-24">
            <Card bordered={false} className="criclebox cardbody h-full">
             
              <div className="ant-list-box table-responsive">
              <Table className="table-hover table-striped">
                  <thead>
                    <tr>
                      <th className="border-0">Image</th>
                      <th className="border-0">Name</th>
                      <th className="border-0">Adress</th>
                      <th className="border-0">Level</th>
                      <th className="border-0">Birth date</th>
                      <th className="border-0">Phone</th>
                      <th className="border-0">Enter Time</th>
                      <th className="border-0">Quit Time</th>
                    </tr>
                  </thead>
                  <tbody>
                  {data.map((waiting) => (
                    <tr>
                      <td>{waiting.id}</td>
                      <td>{waiting.name}</td>
                      <td>{waiting.adress}</td>
                      <td>{waiting.level}</td>
                      <td>{waiting.birthDate}</td>
                      <td>{waiting.phone}</td>
                      <td>{waiting.enterTime}</td>
                      <td>{waiting.quitTime}</td>
                      
                    </tr>
                     ))}
                  </tbody>
                </Table>
              </div>
              {/* <div className="uploadfile shadow-none">
                <Upload {...uploadProps}>
                  <Button
                    type="dashed"
                    className="ant-full-box"
                    icon={<ToTopOutlined />}
                  >
                    <span className="click">Click to Upload</span>
                  </Button>
                </Upload>
              </div> */}
            </Card>
          </Col>
         
        </Row>

        
      </div>
    </>
  );
}

export default Home;
