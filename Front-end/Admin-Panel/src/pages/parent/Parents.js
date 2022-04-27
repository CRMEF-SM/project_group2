// @ts-nocheck
import React, { useEffect, useState } from "react";
import axios from 'axios';
// react-bootstrap components
import {
  Row,
  Col,
  Card,
  Button,
  Typography,
  Table,
  Modal,
  Input,
  Form,
} from "antd";


// Images
import { useHistory } from "react-router-dom";
import { DeleteOutlined, EditOutlined } from "@ant-design/icons";

const { Title } = Typography;



function Parents() {
  const [data, setData] = useState([]);
  const history = useHistory();
  const [nom, setNom] = useState('');
  const [prenom, setPrenom] = useState('');
  const [cin, setCin] = useState('');
  const [adresse, setAdresse] = useState('');
  const [phone, setPhone] = useState('');

// table code start
const columns = [
  {
    title: "Image",
    dataIndex: "photo",
    key: "photo",
     width: "40%",
     render: theImageURL => <img width="50px" src={"http://localhost/images/"+theImageURL} />
  },
  {
    title: "First Name",
    dataIndex: "first_name",
    key: "nom",
     width: "40%",
  },
  {
    title: "Last Name",
    dataIndex: "last_name",
    key: "prenom",
     width: "40%",
  },
  {
    title: "CIN",
    dataIndex: "cin",
    key: "cin",
     width: "40%",
  },
  {
    title: "Adress",
    dataIndex: "adresse",
    key: "adresse",
    width: "40%",
  },

  {
    title: "Phone",
    key: "phone",
    dataIndex: "phone",
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
const [isEditing, setIsEditing] = useState(false);
const [editingStudent, setEditingStudent] = useState(null);

const handleDelete = person => {
  axios
  .delete(`http://localhost/api/parents/${person.id}`)
  .then(response => {
  });  
  history.push('/parents');
}



const onEditStudent = async (record) => {
  setIsEditing(true);
  await axios.put(`http://localhost/api/parents/${record.id}`,
  { nom : nom,
   prenom : prenom,
   cin : cin,
   phone : phone,
   adresse : adresse}
 ) .then(function (response) {
   
   console.log(response);
 })
};
const resetEditing = () => {
  setIsEditing(false);
  setEditingStudent(null);
};

const getParent = async () => {
await axios.get(`http://localhost/api/parents`)
.then((response) =>{
  const parents = response.data;
  console.log("parents",parents);
  setData(parents);
});

}


useEffect(()=> getParent(),[]);


const onFinish  = async (e,person) => {
  e.preventDefault();
  await axios.put(`http://localhost/api/parents/${person}`,
       { nom : nom,
        prenom : prenom,
        cin : cin,
        phone : phone,
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
              title="Parents list"
            >
              <Col xs="24" xl={6}>
               <Button
                      htmlType="submit"
                      style={{ width: "100%" ,
                      background:"#5CA89F" ,
                      color: "white"}}
                      onClick={() => { history.push('/parent/Forum') }}
                    
                    >
                      Add new parent
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
                  </Col>
                </Row>
                </Form>
        </Modal>
      </div>
    </>
  );
}

export default Parents;