// @ts-nocheck

import React, { useContext, useEffect, useRef, useState } from "react";
import AuthContext from "../../context/AuthProvider";
import {
  Layout,
  Button,
  Row,
  Col,
  Typography,
  Form,
  Input,
} from "antd";
import signinbg from "../../assets/images/children.jpg";
import axios from 'axios'
import { useHistory } from "react-router-dom";

const { Title } = Typography;
const { Header, Footer, Content } = Layout;

export default function  SignIn ()  {


  

    const [email, setEmail] = useState('admin@admin.com');
    const [password, setPassword] = useState('password');
    const {setAuth } = useContext(AuthContext);
    const [errMsg, setErrMsg] = useState('');
    const [success, setSuccess] = useState(false);
    const userRef = useRef();
    const errRef = useRef();
    const history = useHistory();
   

  useEffect(() => {
      setErrMsg('');
  }, [email, password])


    const handleSubmit = async (e) => {
      history.push('/dashboard')


      // remove comments to the section below so u can add login api 
      //else if u didn't remove it u can connect by whatever the email and password u want 




      //e.preventDefault();

      // try {
      //     const response = await axios.post('',
      //         JSON.stringify({ email, password }),
      //         {
      //             headers: { 'Content-Type': 'application/json' }
      //         }
      //     );
      //     console.log(JSON.stringify(response?.data));
      //     //console.log(JSON.stringify(response));
      //     //const accessToken = response?.data?.accessToken;
      //     setAuth({ email, password});
      //     setSuccess(true);
      // } catch (err) {
      //     if (!err?.response) {
      //         setErrMsg('No Server Response');
      //     } else if (err.response?.status === 400) {
      //         setErrMsg('Missing Email or Password');
      //     } else if (err.response?.status === 401) {
      //         setErrMsg('Unauthorized');
      //     } else {
      //         setErrMsg('Login Failed');
      //     }
      //     errRef.current.focus();
      // }
      
    }

    const onFinishFailed = (errorInfo) => {
      console.log("Failed:", errorInfo);
    };



    return (
      <>
        <Layout className="layout-default layout-signin"> 
        
          <Header>
            <div className="header-col header-brand"> 
            <h5>Kid's Campus</h5>
              {/* <img src={logo} sizes={20} alt="" /> */}
            </div>
            
          </Header>
          {success ? (
                <section>
                    <h1>You are logged in!</h1>
                    <br />
                    <p>
                        <a href="#">Go to Home</a>
                    </p>
                </section>
            ) : (
          <Content className="signin">

          <p ref={errRef} className={errMsg ? "errmsg" : "offscreen"} aria-live="assertive">{errMsg}</p>
            <Row gutter={[24, 0]} justify="space-around">
              <Col
                xs={{ span: 24, offset: 0 }}
                lg={{ span: 6, offset: 2 }}
                md={{ span: 12 }}
              >
                <Title className="mb-15">Sign In</Title>
                <Title className="font-regular text-muted" level={5}>
                  Enter your email and password to sign in
                </Title>
                <Form
                  onFinish={handleSubmit}
                  onFinishFailed={onFinishFailed}
                  layout="vertical"
                  className="row-col"
                >
                  <Form.Item
                    className="username"
                    label="Email"
                    name="email"
                    onChange={e => setEmail(e.target.value)}
                    rules={[
                      {
                        required: true,
                        message: "Please input your email!",
                      },
                    ]}
                  >
                    <Input placeholder="Email" />
                  </Form.Item>

                  <Form.Item
                    className="username"
                    label="Password"
                    name="password"
                    onChange={e => setPassword(e.target.value)}
                    rules={[
                      {
                        required: true,
                        message: "Please input your password!",
                      },
                    ]}
                  >
                    <Input type="password" placeholder="Password" />
                  </Form.Item>

                  

                  <Form.Item>
                    <Button
                      htmlType="submit"
                      style={{ width: "100%" ,
                      background:"#5CA89F" ,
                    color: "white"}}
                    >
                      SIGN IN
                    </Button>
                  </Form.Item>
                
                </Form>
              </Col>
              <Col
                className="sign-img"
                style={{ padding: 12 }}
                xs={{ span: 24 }}
                lg={{ span: 12 }}
                md={{ span: 12 }}
              >
                <img src={signinbg} alt="" />
              </Col>
            </Row>
          </Content>
            )}
          <Footer>

            
          </Footer>
        </Layout>
      </>
    );
  
}
