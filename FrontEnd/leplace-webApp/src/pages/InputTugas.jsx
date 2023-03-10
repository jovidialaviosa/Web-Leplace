import React, { useEffect, useState } from "react";
import Home from "../components/Home";
import Header from "../components/Header";
import Swal from "sweetalert2";
import axios from "axios";
import { useNavigate } from "react-router-dom";

const InputTugas = () => {
  const [judul, setJudul] = useState();
  const [deskripsi, setDeskripsi] = useState();;
  const [file, setFile] = useState(null);
  const navigate = useNavigate();

  const formData = {
    judul: judul,
    deskripsi: deskripsi,
    file_tugas: file
  };

  useEffect(() => {
    console.log("File has been set.");
  }, [file]);

  const uploadTugasHandler = async (e) => {
    e.preventDefault();
    try {
      const config = {
        headers: {
          "Content-Type": "multipart/form-data",
        },
      };
      const dataTugas = await axios
        .post("http://localhost:8000/api/tugas", formData, config)
        .then((res) => {
          console.log(res);
          Swal.fire(
            "Input Tugas Berhasil",
            "Tugas berhasil ditambahkan",
            "success"
          );
          navigate("/");
        });
    } catch (error) {
      console.log(error);
      Swal.fire({
        icon: "error",
        title: "Input Tugas Gagal",
        text: "Ada keluhan pada server atau form input",
      });
    }
  };

  return (
    <>
      <div className="flex">
        <Home />
        <div className="flex flex-col w-screen">
          <Header name="Input Tugas" />
          <div className="gap-4 pl-10 pr-10 pt-10">
            <div class="block w-full rounded-lg border border-gray-200 bg-white p-6 shadow-md">
              <form onSubmit={uploadTugasHandler}>
                <div class="mb-6">
                  <label
                    for="mata_kuliah"
                    class="block mb-2 text-sm font-medium text-gray-900"
                  >
                    Judul
                  </label>
                  <input
                    type="text"
                    id="mata_kuliah"
                    value={judul}
                    onChange={(e) => setJudul(e.target.value)}
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-2/6 p-2.5 "
                    placeholder="Masukan Judul"
                    required
                  />
                </div>
                <div class="mb-6">
                  <label
                    for="deskripsi"
                    class="block mb-2 text-sm font-medium text-gray-900"
                  >
                    Deskripsi
                  </label>
                  <textarea
                    type="deskripsi"
                    id="deskripsi"
                    value={deskripsi}
                    onChange={(e) => setDeskripsi(e.target.value)}
                    rows="3"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/2 p-2.5 "
                    placeholder="Masukkan Deskripsi atau keterangan"
                    required
                  />
                </div>

                <div className="mt-5 flex flex-col justify-start gap-3">
                  <label
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    for="file_input"
                  >
                    Upload file Tugas
                  </label>
                  <input
                    class="block w-1/2 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none"
                    id="file_input"
                    type="file"
                    onChange={(e) => setFile(e.target.files[0])}
                  />

                  <div className="flex justify-center">
                    <button
                      type="submit"
                      className="btn bg-emerald-600 hover:bg-emerald-700 border-transparent hover:border-transparent  btn-xl mt-3 w-40 text-white"
                    >
                      Upload Tugas
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </>
  );
};

export default InputTugas;
