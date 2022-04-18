// @ts-nocheck
import React, { useEffect, useState } from "react";
import axios from 'axios';
// react-bootstrap components
import {
  Row,
  Col,
  Card,
  Table,
  Button,
  Avatar,
  Typography,
  Form,
  Modal,
  Input,
} from "antd";


// Images
import face2 from "../../assets/images/face-2.jpg";
import { useHistory } from "react-router-dom";
import { DeleteOutlined, EditOutlined } from "@ant-design/icons";

const { Title } = Typography;



const dataTable = [ 
  
  {
    name: (
      <>
        <Avatar.Group>
          <Avatar
            className="shape-avatar"
            shape="square"
            size={40}
            src={face2}
          ></Avatar>
          <div className="avatar-info">
            <Title level={5}>Michael John</Title>
            <p>michael@mail.com</p>
          </div>
        </Avatar.Group>{" "}
      </>
    ),
    function: (
      <>
        <div className="author-info">
          <Title level={5}>Manager</Title>
          <p>Organization</p>
        </div>
      </>
    ),

    status: (
      <>
        <Button type="primary" className="tag-primary">
          ONLINE
        </Button>
      </>
    ),
    employed: (
      <>
        <div className="ant-employed">
          <span>23/04/18</span>
          <a href="#pablo">Edit</a>
        </div>
      </>
    ),
  },


]   

function Tables() {
  const [data, setData] = useState([]);
  const history = useHistory();
  const [isEditing, setIsEditing] = useState(false);
const [editingStudent, setEditingStudent] = useState(null);
const [nom, setNom] = useState('');
const [prenom, setPrenom] = useState('');
const [niveau, setNiveau] = useState('');
const [adresse, setAdresse] = useState('');

// table code start
const columns = [
  {
    title: "Student",
    dataIndex: "nom",
    key: "first_name",
    width: "40%",
  },
  {
    title: "Last name",
    dataIndex: "prenom",
    key: "prenom",
    width: "40%",
  },
  {
    title: "Adress",
    dataIndex: "adresse",
    key: "adresse",
    width: "40%",
  },
  {
    title: "Level",
    key: "niveau",
    dataIndex: "niveau",
    width: "40%",
  },
  {
    title: "Actions",
    key: "actions",
    render: (record) => {
      return (
        <>
          <EditOutlined
            onClick={() => {

              onEditStudent(record);
            }}
          />
          <DeleteOutlined
            onClick={() => {

              onDeleteStudent(record);
            }}
            style={{ color: "red", marginLeft: 12 }}
          />
        </>
      )}
          }
];




const onEditStudent = async (record) => {
  setIsEditing(true);
  await axios.put(`http://localhost:3004/student/${record.id}`,
  { nom : nom,
   prenom : prenom,
   niveau : niveau,
   adresse : adresse}
 ) .then(function (response) {
   
   console.log(response);
 })
};
const resetEditing = () => {
  setIsEditing(false);
  setEditingStudent(null);
};


const getStudent = async () => {
await axios.get(`http://localhost/api/students`)
.then((response) =>{
  const Students = response.data;
  console.log("Students",Students);
  setData(Students );
} );

}

const handleDelete = person => {
  axios
  .delete(`http://localhost:3004/Student/${person.id}`)
  .then(response => {
  
  });  
}

useEffect(()=> getStudent(),[]);

const onFinish  = async (e,person) => {
  e.preventDefault();
  await axios.put(`http://localhost:3004/student/${person}`,
       { nom : nom,
        prenom : prenom,
        niveau : niveau,
        adresse : adresse}
      ) .then(function (response) {
        
        console.log(response);
      })
}

const onFinishFailed = (errorInfo) => {
  console.log("Failed:", errorInfo);
};

const onDeleteStudent = (record) => {
  Modal.confirm({
    title: "Are you sure, you want to delete this student record?",
    okText: "Yes",
    okType: "danger",
    onOk: () => {
     handleDelete(record);
    },
  });
};

  return (
    <>
      <div className="tabled">
        <Row gutter={[24, 0]}>
          <Col xs="24" xl={24}>
            <Card
              bordered={false}
              className="criclebox tablespace mb-24"
              title="Students list"
            >
               <Col xs="24" xl={6}>
               <Button
                      htmlType="submit"
                      style={{ width: "100%" ,
                      background:"#5CA89F" ,
                      color: "white"}}
                      onClick={() => { history.push('/students/Forum') }}
                    
                    >
                      Add new Student
                    </Button>
              </Col>
              <div className="table-responsive">
                <Table
                  columns={columns}
                  dataSource={data}
                  pagination={false}
                  className="ant-border-space"
                />
              </div>
            </Card>

          </Col>
        </Row>
        <Modal
          title="Edit Parent"
          visible={isEditing}
          okText="Save"
          onCancel={() => {
            resetEditing();
          }}
          onOk={() => {
            setData((pre) => {
              return pre.map((student) => {
                if (student.id === editingStudent.id) {
                  return editingStudent;
                } else {
                  return student;
                }
              });
            });
            resetEditing();
          }}
        >
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
                    label="Level"
                    name="cin"
                    onChange={e => setNiveau(e.target.value)}
                    rules={[
                      {
                        required: true,
                        message: "Please input your Level!",
                      },
                    ]}
                  >
                    <Input placeholder="Level" />
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
                 
                  </Col>
                </Row>
                </Form>
        </Modal>
      </div>
    </>
  );
}

export default Tables;
