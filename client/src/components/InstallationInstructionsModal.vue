<template>
  <div
    class="overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex"
  >
    <div class="relative w-auto my-6 mx-auto max-w-6xl">
      <!--content-->
      <div
        class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none"
      >
        <!--header-->
        <div
          class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t"
        >
          <h3 class="text-3xl font-semibold">
            Kurulum Dosyası İle Kurulum Talimatları
          </h3>
        </div>
        <!--body-->
        <div
          class="relative p-6 flex-auto text-gray-800 leading-relaxed text-lg"
        >
          <p class="my-4">
            Kurulumu gerçekleştirmek için Pardus işletim sisteminde sırasıyla şu
            adımları takip ediniz.
          </p>
          <ol class="list-decimal ml-8 space-y-4">
            <li>
              Kaydettiğiniz {{ filename }} adlı dosyayı Pardus Masaüstüne
              kopyalayınız. (Farklı bir dizine kopyalamak, ileriki maddelerde
              değişiklik yapmayı gerektirir.)
            </li>
            <li>
              Super (Windows) tuşuna basınız, "Uçbirim" şeklinde arama yaparak
              Uçbirim öykünücüsünü açınız.
            </li>
            <li>
              " chmod +x ~/Masaüstü/{{ filename }} && sudo sh ~/Masaüstü/{{
                filename
              }}
              " ifadesini tırnaklar olmadan kopyalayınız, uçbirime yapıştırıp
              enter tuşuna basınız.
            </li>
            <li>
              Kurulumların gerçekleştirilebilmesi için bir kereye mahsus olarak
              yönetici parolası istenecektir. Parolayı girip enter tuşuna
              basınız.
            </li>
            <li>
              Kurulum için gerekli dosyalar internetten otomatik olarak
              indirilecek ve yüklenecektir, bu esnada yapılan işlemlere dair
              bilgilendirme mesajları ekranda görünecektir, yüklemelerin
              tamamlanmasını bekleyiniz.
            </li>
          </ol>
        </div>
        <!--footer-->
        <div
          class="flex items-center justify-end p-6 border-t border-solid border-blueGray-200 rounded-b"
        >
          <button
            class="text-red-500 bg-transparent border border-solid border-red-500 hover:bg-red-500 hover:text-white active:bg-red-600 font-bold uppercase text-sm px-6 py-3 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
            type="button"
            @click="$emit('close')"
          >
            Kapat
          </button>
        </div>
      </div>
    </div>
  </div>
  <div class="opacity-25 fixed inset-0 z-40 bg-black"></div>
</template>

<script>
export default {
  name: "InstallationInstructionsModal",
  props: {
    filename: {
      type: String,
      required: true,
    },
  },
};
</script>
