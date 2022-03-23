// @ts-nocheck

import { useState } from "react";

import {
  Row,
  Col,
  Card,
  Button,
  Avatar,
  Form,
  Input,
  Upload,
  message,
} from "antd";

import {
  VerticalAlignTopOutlined,
} from "@ant-design/icons";

import profilavatar from "../../assets/images/face-1.jpg";
import axios from 'axios'
import { useHistory } from "react-router-dom";

function Forum() {  
  const [imageURL, setImageURL] = useState(false);
  const [, setLoading] = useState(false);
  const [nom, setNom] = useState('');
  const [prenom, setPrenom] = useState('');
  const [cin, setCin] = useState('');
  const [adresse, setAdresse] = useState('');
  const [phone, setPhone] = useState('');
  const history = useHistory();



  const onFinishFailed = (errorInfo) => {
    console.log("Failed:", errorInfo);
  };


  const getBase64 = (img, callback) => {
    const reader = new FileReader();
    reader.addEventListener("load", () => callback(reader.result));
    reader.readAsDataURL(img);
  };

  const beforeUpload = (file) => {
    const isJpgOrPng = file.type === "image/jpeg" || file.type === "image/png";
    if (!isJpgOrPng) {
      message.error("You can only upload JPG/PNG file!");
    }
    const isLt2M = file.size / 1024 / 1024 < 2;
    if (!isLt2M) {
      message.error("Image must smaller than 2MB!");
    }
    return isJpgOrPng && isLt2M;
  };

  const handleChange = (info) => {
      getBase64(info.file.originFileObj, (imageUrl) => {
        setLoading(false);
        setImageURL(info);
      });
    
  };

  const onFinish  = async (e) => {
    await axios.post('http://localhost:3004/parent',
         { nom : nom,
          prenom : prenom,
          cin : cin,
          phone : phone,
          adresse : adresse}
        ) .then(function (response) {
          
          console.log(response);
        })
    history.push('/parents')
  }

  

  const uploadButton = (
    <div className="ant-upload-text font-semibold text-dark">
      {<VerticalAlignTopOutlined style={{ width: 20, color: "#000" }} />}
      <div>Upload New Image</div>
    </div>
  );


  return (
    <>
     
      <Card
        title={
          <Row justify="space-between" align="middle" gutter={[24, 0]}>
           
              <Col span={6} md={6} className="col-info">
              <Upload
              name="image"
              listType="picture-card"
              className="avatar-uploader projects-uploader"
              showUploadList={false}
              //action="https://www.mocky.io/v2/5cc8019d300000980a055e76"
              beforeUpload={beforeUpload}
              onChange={handleChange}
            >
              
              {imageURL ? (
               <Col span={6} md={6} className="col-info">
              <Avatar.Group>
                <Avatar size={100} shape="square" src={imageURL} />
              </Avatar.Group> <p>{imageURL}</p>
              <div>hey youuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuu</div>
              </Col>
              ) : (
                uploadButton
              )}
            </Upload>
           
            </Col>
            <Col span={24} md={24} className="col-info">
            <Form
                  onFinish={onFinish}
                  onFinishFailed={onFinishFailed}
                  layout="vertical"
                  className="row-col"
                >
            <Row justify="space-between" align="middle" gutter={[24, 0]}>
            <Col span={12} md={12} className="col-info">
                  <Form.Item
                    className="username"
                    label="First name"
                    name="nom"
                    onChange={e => setNom(e.target.value)}
                    rules={[
                      {
                        required: true,
                        message: "Please input your name",
                      },
                    ]}
                  >
                    <Input placeholder="First name" />
                  </Form.Item>
                  </Col>
                  <Col span={12} md={12} className="col-info">
                  <Form.Item
                    className="username"
                    label="Last name"
                    name="prenom"
                    onChange={e => setPrenom(e.target.value)}
                    rules={[
                      {
                        required: true,
                        message: "Please input your Last name!",
                      },
                    ]}
                  >
                    <Input placeholder="Last name" />
                  </Form.Item>
                  </Col>


                  <Col span={12} md={12} className="col-info">
                  <Form.Item
                    className="username"
                    label="Cin"
                    name="cin"
                    onChange={e => setCin(e.target.value)}
                    rules={[
                      {
                        required: true,
                        message: "Please input your CIN!",
                      },
                    ]}
                  >
                    <Input placeholder="Cin" />
                  </Form.Item>
                   </Col>

                   <Col span={12} md={12} className="col-info">
                  <Form.Item
                    className="username"
                    label="Phone"
                    name="phone"
                    onChange={e => setPhone(e.target.value)}
                    rules={[
                      {
                        required: true,
                        message: "Please input your Phone number!",
                      },
                    ]}
                  >
                    <Input placeholder="Phone" />
                  </Form.Item>
                  </Col>


                   <Col span={24} md={24} className="col-info">
                  <Form.Item
                    className="username"
                    label="Adress"
                    name="adress"
                    onChange={e => setAdresse(e.target.value)}
                    rules={[
                      {
                        required: true,
                        message: "Please input your Adress!",
                      },
                    ]}
                  >
                    <Input placeholder="Adress" />
                  </Form.Item>
                  </Col>
                  <Col span={24} md={24} className="col-info">
                  <Form.Item>
                    <Button
                      htmlType="submit"
                      style={{ width: "100%" ,
                      background:"#5CA89F" ,
                    color: "white"}}
                    >
                      Add
                    </Button>
                  </Form.Item>
                  </Col>
                </Row>
                </Form>
                </Col>
          </Row>
        }
      ></Card>

     
    </>
  );
}

export default Forum;
