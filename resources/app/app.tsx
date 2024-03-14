import React, { useCallback, useEffect, useMemo, useState } from "react";
import { Button, Card, Space, Table } from 'antd';
import {
    DeleteOutlined,
    EditOutlined,
    UserAddOutlined
} from '@ant-design/icons';
import axios from "axios";
import dayjs from "dayjs";

const App = () => {
    const [data, setData] = useState([])
    const columns = useMemo(() => [
        { title: 'Nome', dataIndex: 'name', key: 'name' },
        { title: 'E-mail', dataIndex: 'email', key: 'email'},
        { 
            title: 'Telefones', dataIndex: 'phones', key: 'phones',
            render: data => data.join(', '), 
        },
        { 
            title: 'Nascimento', dataIndex: 'birthday', key: 'birthday',
            render: data => dayjs(data).format('DD/MM/YYYY')
        },
        { title: 'CPF', dataIndex: 'document', key: 'document' },
        // { 
        //     title: 'Ações', dataIndex: 'actions', key: 'actions',
        //     render: (_, record) => <>
        //         <Button size="small" type="default" icon={<EditOutlined />} >Editar</Button>
        //         <Button size="small" danger type="default" icon={<DeleteOutlined />} >Apagar</Button>
        //     </>
        // }
    ], [])
    
    const getData = useCallback(async () => {
        try {
            const response = await axios.get('/api/contacts');
            setData(response.data?.data || [])
        } catch (error) {
            
        }
    }, [])

    useEffect(() => {
        getData()
    }, [])
  return (
    <Card 
        title={'Contatos'}
        // extra={<Button type="primary" icon={<UserAddOutlined />}>Novo</Button>}
    >
        <Table 
            dataSource={data} 
            columns={columns} 
            rowKey={'id'}
        />
    </Card>
  );
}

export default App;